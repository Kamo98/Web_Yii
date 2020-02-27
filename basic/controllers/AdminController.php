<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 23.02.2020
 * Time: 19:37
 */

namespace app\controllers;


use app\models\Discipline;
use app\models\FilterTeachers;
use app\models\Teacher;
use app\models\TeacherModel;
use app\models\TeacherProfile;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionMain () {
        $filterTeachersModel = new FilterTeachers();
        $isFilter = false;

        if ($filterTeachersModel->load(Yii::$app->request->post())) {
            Yii::debug(array2str($filterTeachersModel), "TEST");
            $isFilter = true;
        }

        $query = TeacherProfile::find();

        if ($isFilter) {
            $prices = explode('-', $filterTeachersModel['price']);

            $teacherProfiles = $query
                ->where(
                    ['and', 'id_discipline=:id_discipline', ['between', 'price', $prices[0], $prices[1]]],
                    ['id_discipline' => $filterTeachersModel['discipline']])
                ->all();
        } else {
            $teacherProfiles = $query
                ->all();
        }

        $disciplines = Discipline::find()->all();

        return $this->render('main_admin', [
            'teacherProfiles' => $teacherProfiles,
            'disciplines' => $disciplines,
            'filterTeachersModel' => $filterTeachersModel
        ]);
    }


    public function actionDelete($id = NULL) {
        if ($id === NULL)
        {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('/admin/main'));
        }

        try {
            TeacherProfile::findOne($id)->delete();
        } catch (StaleObjectException $e) {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('/admin/main'));
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('PostDeletedError');
            Yii::$app->getResponse()->redirect(array('/admin/main'));
        }


        Yii::$app->session->setFlash('PostDeleted');
        Yii::$app->getResponse()->redirect(array('/admin/main'));
    }


    public function actionEdit($id = NULL) {

        $teachEditModel = new TeacherModel();
        $disciplines = Discipline::find()->all();

        if ($id != NULL) {

            $teacher = Teacher::findOne($id);

            if ($teacher === NULL) {
                Yii::$app->session->setFlash('PostEditError');
                Yii::$app->getResponse()->redirect(array('/admin/main'));
            }

            if ($teachEditModel->load(Yii::$app->request->post())) {
                $teacher["FIO"] = $teachEditModel->FIO;
                $teacher["education"] = $teachEditModel->education;
                $teacher["about_me"] = $teachEditModel->aboutMe;
                $teacher["experience"] = $teachEditModel->experience;
                $teacher["phone"] = $teachEditModel->phone;
                $teacher["email"] = $teachEditModel->email;

                $profiles = TeacherProfile::find()->where(['id_teacher' => $id])->all();
                foreach ($profiles as $prof) {
                    try {
                        $prof->delete();
                    } catch (StaleObjectException $e) {
                    } catch (\Throwable $e) {
                    }
                }

                $i = 0;
                foreach ($teachEditModel->disciplines as $disc) {
                    if ($disc != 0) {
                        $teachProfile = new TeacherProfile();
                        $teachProfile['id_discipline'] = $disc;
                        $teachProfile['id_teacher'] = $id;
                        $teachProfile['price'] = $teachEditModel->prices[$i];
                        $teachProfile->save();
                    }
                    $i++;
                }
                $teacher->save();

                Yii::$app->session->setFlash('SaveTeachSuccess');
            } else {

                $teachEditModel->FIO = $teacher["FIO"];
                $teachEditModel->education = $teacher["education"];
                $teachEditModel->aboutMe = $teacher["about_me"];
                $teachEditModel->experience = $teacher["experience"];
                $teachEditModel->phone = $teacher["phone"];
                $teachEditModel->email = $teacher["email"];

                $profiles = TeacherProfile::find()->where(['id_teacher' => $id])->all();

                $i = 0;
                foreach ($profiles as $prof) {
                    $teachEditModel->disciplines[$i] = $prof->discipline['id_discipline'];
                    $teachEditModel->prices[$i] = $prof['price'];
                    $i++;
                }
            }
        } else {
            if ($teachEditModel->load(Yii::$app->request->post())) {
                $teacher = new Teacher();

                $teacher["FIO"] = $teachEditModel->FIO;
                $teacher["education"] = $teachEditModel->education;
                $teacher["about_me"] = $teachEditModel->aboutMe;
                $teacher["experience"] = $teachEditModel->experience;
                $teacher["phone"] = $teachEditModel->phone;
                $teacher["email"] = $teachEditModel->email;
                $teacher["login"] = $teachEditModel->email;
                $teacher["password"] = $teachEditModel->email;
                $teacher->save();

                $i = 0;
                foreach ($teachEditModel->disciplines as $disc) {
                    if ($disc != 0) {
                        $teachProfile = new TeacherProfile();
                        $teachProfile['id_discipline'] = $disc;
                        $teachProfile['id_teacher'] = $teacher['id_teacher'];
                        $teachProfile['price'] = $teachEditModel->prices[$i];
                        $teachProfile->save();
                    }
                    $i++;
                }

                Yii::$app->session->setFlash('AddTeachSuccess');
            }
        }


        return $this->render('teach_edit', [
            'teachEditModel' => $teachEditModel,
            'disciplines' => $disciplines
        ]);
    }
}