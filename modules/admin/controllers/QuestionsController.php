<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\admin\controllers\BasicController;
use app\modules\admin\models\Questions;
use app\modules\admin\models\Answer;
use app\modules\admin\models\SysLog;


class QuestionsController extends BasicController
{
    /**
     * 问题列表
     */
    public function actionQuestionList()
    {
        $get = Yii::$app->request->get();
        if(isset($get['page'])){
            $currPage = (int)$get['page']?$get['page']:1;
        }else{
            $currPage = 1;
        }
    	$questionsModel = Questions::find();
        $count = $questionsModel->count();
        $pageSize = Yii::$app->params['pageSize'];
        $questionList = $questionsModel->with('answer')->offset($pageSize*($currPage-1))->limit($pageSize)->asArray()->all();
        // P($questionList);
    	return $this->render('questionList', [
            'questionList' => $questionList,
    		'pageInfo' => [
                'count' => $count,
                'currPage' => $currPage,
                'pageSize' => $pageSize,
            ]
    	]);
    }

    /**
     * 添加问题
     */
    public function actionAddQuestion()
    {
    	if(Yii::$app->request->isPost){
    		$post = Yii::$app->request->post();
            // P($post);
            if(!isset($post['Answer']['answer_content']) or !isset($post['Answer']['answer_id'])){
                return showRes(300, '请填写答案，并选择一个正确答案！');
            }
    		$questionsModel = new Questions;
    		if($questionsModel->addQuestion($post)){
                return showRes(200, '添加成功', Url::to(['questions/question-list']));
                Yii::$app->end();
            }else{
                if($questionsModel->hasErrors()){
                    return showRes(300, $questionsModel->getErrors());
                }else{
                    return showRes(300, '添加失败');
                }
            }
    		return;
    	}
        return $this->render('addQuestion');
    }

    /*
    修改问题
    */
    public function actionModQuestion()
    {
        /*如果有数据，进行修改*/
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if(!isset($post['Answer']['answer_content']) or !isset($post['Answer']['answer_id'])){
                return showRes(300, '请填写答案，并选择一个正确答案！');
            }
            $id = (int)(isset($post['Questions']['qid'])?$post['Questions']['qid']:0);
            if(!$id){
                return showRes(300, '参数有误！');
                Yii::$app->end();
            }
            $questionsModel = new Questions;
            if($questionsModel->modQuestion($id, $post)){
                return showRes(200, '修改成功', Url::to(['questions/question-list']));
                Yii::$app->end();
            }else{
                if($questionsModel->hasErrors()){
                    return showRes(300, $questionsModel->getErrors());
                }else{
                    return showRes(300, '修改失败');
                }
            }
            return;
        }

        $get = Yii::$app->request->get();
        $id = (int)(isset($get['id'])?$get['id']:0);
        if(!$id){
            return showRes(300, '参数有误！');
            Yii::$app->end();
        }
        $question = Questions::find()->where('qid = :id', [':id' => $id])->asArray()->one();

        /*取出答案*/
        if(!empty($question)){
            $answer = Answer::find()->where('qid = :id', [':id' => $question['qid']])->asArray()->all();
        }
        // P($answer);

    	return $this->render('modQuestion', [
            'question' => $question,
            'answer' => $answer
        ]);

    }

    /*
	删除问题
    */
    public function actionDelQuestion()
    {
    	$post = Yii::$app->request->post();
    	$id = (int)(isset($post['id'])?$post['id']:0);
    	if(!$id){
    		return showRes(300, '参数有误！');
    		Yii::$app->end();
    	}

        $questionsModel = new Questions;
    	if($questionsModel->delQuestion($id)){
    		return showRes(200, '删除成功', Url::to(['questions/question-list']));
            Yii::$app->end();
    	}else{
    		return showRes(300, '删除失败');
            Yii::$app->end();
    	}
    }


}
