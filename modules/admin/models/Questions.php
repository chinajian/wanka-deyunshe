<?php

namespace app\modules\admin\models;

use Yii;

class Questions extends \yii\db\ActiveRecord
{    
    public static function tableName()
    {
        return '{{%questions}}';
    }

    public function rules()
    {
        return [
            ['question', 'required', 'message' => '名称不能为空'],
            ['question', 'string', 'max' => 256],
            [['last_modify_time', 'create_time'], 'safe'],
        ];
    }

    /*添加问题*/
    public function addQuestion($data)
    {
        $data['Questions']['last_modify_time'] = time();
        $data['Questions']['create_time'] = time();
        if($this->load($data) and $this->validate()){
            $transaction = Yii::$app->db->beginTransaction();//事物处理
            try{
                $this->save(false);
                $questions_id = $this->getPrimaryKey();
                
                /*添加答案>>>*/
                foreach($data['Answer']['answer_content'] as $k => $v){
                    $answerModel = new Answer;
                    if($k == ($data['Answer']['answer_id']-1)){
                        $is_true = 2;
                    }else{
                        $is_true = 1;
                    }

                    $inseartData = array(
                        'Answer' => array(
                            'qid' => $questions_id,
                            'answer_content' => $v,
                            'is_true' => $is_true 
                        )
                    );
                    // P($inseartData);

                    if(!$answerModel->addAnswer($inseartData)){
                        if($answerModel->hasErrors()){
                            $this->addError('question', $answerModel->getErrors());
                        }else{
                            $this->addError('question', '添加答案失败');
                        }
                        return false;
                    }
                }
                /*添加答案<<<*/

                /*写入日志*/
                SysLog::addLog('创建问题['. $data['Questions']['question'] .']成功');
                $transaction->commit();            
                return true;
            }catch(\Exception $e){
                $transaction->rollback();
                throw new \Exception();         
                return false;
            };
        }
        return false;
    }

    /*修改问题*/
    public function modQuestion($id, $data)
    {
        $data['Questions']['last_modify_time'] = time();
        // P($data);
        if($this->load($data) and $this->validate()){
            $question = self::find()->where('qid = :id', [':id' => $id])->one();
            if(is_null($question)){
               return false; 
            }

            $transaction = Yii::$app->db->beginTransaction();//事物处理
            try{
                $question->question = $data['Questions']['question'];
                $question->save(false);
                $questions_id = $question->qid;
                
                /*修改答案>>>*/
                foreach($data['Answer']['answer_content'] as $k => $v){
                    $answerModel = new Answer;
                    if($k == ($data['Answer']['answer_id']-1)){
                        $is_true = 2;
                    }else{
                        $is_true = 1;
                    }

                    $newData['Answer'] = array();
                    $newData['Answer']['qid'] = $questions_id;
                    $newData['Answer']['answer_content'] = $v;
                    $newData['Answer']['is_true'] = $is_true;
                    // P($newData);
                    if(!$answerModel->modAnswer($questions_id, $newData, $k)){
                        if($answerModel->hasErrors()){
                            $this->addError('question', $answerModel->getErrors());
                        }else{
                            $this->addError('question', '修改答案失败');
                        }
                        return false;
                    }
                    /*
                    删除之前多余的答案，比如之前有3条记录，现在只有2条记录
                    limit(3),因为答案最多只能有3条记录
                    */
                    $answer = Answer::find()->where('qid = :id', [':id' => $questions_id])->offset($k+1)->limit(3)->all();
                    foreach($answer as $k => $v){
                        $answer[$k]->delete();
                    }
                }
                /*添加答案<<<*/

                /*写入日志*/
                SysLog::addLog('修改问题['. $question->question .']成功');
                $transaction->commit();            
                return true;
            }catch(\Exception $e){
                $transaction->rollback();
                throw new \Exception();         
                return false;
            };




            $question = self::find()->where('qid = :id', [':id' => $id])->one();
            if(is_null($question)){
               return false; 
            }
            // P($question);
            $question->question = $data['Questions']['question'];
            if($question->save(false)){
                /*写入日志*/
                SysLog::addLog('修改问题['. $question->question .']成功');
                return true;
            }
            return false;
        }
    }
    
    /*删除问题 包括答案*/
    public function delQuestion($id)
    {
        $question = Questions::find()->where('qid = :id', [':id' => $id])->one();
        if($question){
            $transaction = Yii::$app->db->beginTransaction();//事物处理
            try{
                $question->delete();

                $answerModel = new Answer;
                $answerModel->deleteAll(['qid' => $id]);

                /*写入日志*/
                SysLog::addLog('删除问题['. $question->question .']成功');
                $transaction->commit();            
                return true;
            }catch(\Exception $e){
                $transaction->rollback();
                throw new \Exception();         
                return false;
            };

            return true;
        }else{
            return false;
        }
    }


    /*关联查询 答案信息*/
    public function getAnswer()
    {
        $answer = $this->hasMany(answer::className(), ['qid' => 'qid']);
        return $answer;
    }

}
