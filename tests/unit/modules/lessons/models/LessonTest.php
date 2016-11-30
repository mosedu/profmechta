<?php

namespace modules\lessons\models;

use app\modules\lessons\models\Leslect;
use app\modules\lessons\models\Lesson;
use app\modules\lectors\models\Lector;

class LessonTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testNotValidEmptyLesson()
    {

        $aErrField = ['les_title', 'les_description', ];
        asort($aErrField);

        $ob = new Lesson();
        $this->assertFalse($ob->validate(), 'Empty lesson sould not be valid');

        $aObError = array_keys($ob->getErrors());
        asort($aObError);

        $this->assertTrue(count($aObError) == count($aErrField), 'Model should has ' . count($aErrField) . ' errors');
        foreach($aErrField As $k => $v) {
            $this->assertTrue(in_array($v, $aObError), 'Model should has error in field ' . $v);
        }
    }

    public function testOkValidationFilledModel()
    {
        $ob = new Lesson();
        $ob->les_title = 'Lesson title';
        $ob->les_description = 'Description';

        $this->assertTrue($ob->validate(), 'Ok filled model should be valid');
    }

    public function testSaveFilledModel()
    {
        $ob = new Lesson();
        $ob->les_title = 'Lesson title';
        $ob->les_description = 'Description';

        $this->assertTrue($ob->save(), 'Ok filled model should be saved');
        $this->assertFalse(empty($ob->les_created), 'Saved model should has created date');
        $this->assertFalse($ob->les_active === null, 'Saved model should has status (' . $ob->les_active . ')');
        $this->assertTrue($ob->les_active == 0, 'Saved model should active = 0');
    }

    /**
     * @dataProvider relatedProvider
     */
    public function testSaveRelatedDates($aLesson, $aLectors)
    {
        $oLesson = new Lesson();
        $oLesson->les_title = $aLesson[0];
        $oLesson->les_description = $aLesson[1];

        $this->assertTrue($oLesson->save(), 'Ok Lesson model should be saved');

        foreach($aLectors As $data) {
            $oLeslec = new Leslect();
            $oLeslec->ll_lesson_id = $oLesson->les_id;
            $oLeslec->ll_lector_id = $data[0];
            $oLeslec->ll_date = $data[1];
            $this->assertTrue($oLeslec->save(), 'Ok Lesson Date model should be saved');
        }

        $this->assertTrue(
            count($oLesson->dates) == count($aLectors),
            'Lesson sould has ' . count($aLectors) . ' dates, but has ' . count($oLesson->dates)
            . ' last attribute = ' . print_r($oLeslec->attributes, true)
        );

    }

    /**
     * @dataProvider relatedUpdateProvider
     */
    public function testUpdateRelatedDates($aLesson, $aLectors1, $aLectors2)
    {
        $oLesson = new Lesson();
        $oLesson->les_title = $aLesson[0];
        $oLesson->les_description = $aLesson[1];

        $this->assertTrue($oLesson->save(), 'Ok Lesson model should be saved');

        foreach($aLectors1 As $data) {
            $oLeslec = new Leslect();
            $oLeslec->ll_lesson_id = $oLesson->les_id;
            $oLeslec->ll_lector_id = $data[0];
            $oLeslec->ll_date = $data[1];
            $this->assertTrue($oLeslec->save(), 'Ok Lesson Date model should be saved');
        }

        $this->assertTrue(
            count($oLesson->dates) == count($aLectors1),
            'Lesson sould has ' . count($aLectors1) . ' dates, but has ' . count($oLesson->dates)
            . ' last attribute = ' . print_r($oLeslec->attributes, true)
        );

        $aNewDates = [];
        foreach($aLectors2 As $data) {
            $aNewDates[] = [
                'll_lesson_id' => $oLesson->les_id,
                'll_lector_id' => $data[0],
                'll_date' => $data[1],
            ];
        }

        $nUpdated = $oLesson->updateDates($aNewDates, date('Y-m-d H:i:s'));
        $this->assertTrue($nUpdated == count($aLectors2), 'Updated All record');

        $oLesson->refresh();
        $this->assertTrue(
            count($oLesson->dates) == (count($aLectors2) + 1),
            'Lesson sould has ' . (count($aLectors2) + 1) . ' dates, but has ' . count($oLesson->dates)
            . ' aNewDates = ' . print_r($aNewDates, true)
        );
    }

    /**
     * @return array
     */
    public function relatedProvider() {
        return [
            [
                ['lesson 1', 'lesson description 1'], // lesson data
                [ // lector data
                    [1, '2016-12-10 10:00:00'],
                    [1, '2016-12-12 10:00:00'],
                    [1, '2016-12-15 10:00:00'],
                ]
            ],
            [
                ['lesson 2', 'lesson description 2'], // lesson data
                [ // lector data
                    [1, '2016-12-10 10:00:00'],
                    [2, '2016-12-10 10:00:00'],
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function relatedUpdateProvider() {
        $tNow = time();
        $nDaySec = 24 * 3600;
        return [
            [
                ['lesson 1', 'lesson description 1'], // lesson data
                [ // lector data
                    [1, date('Y-m-d H:i:s', $tNow - 2 * $nDaySec)],
                    [1, date('Y-m-d H:i:s', $tNow + 2 * $nDaySec)],
                    [1, date('Y-m-d H:i:s', $tNow + 5 * $nDaySec)],
                ],
                [ // lector data
                    [1, date('Y-m-d H:i:s', $tNow + 2 * $nDaySec)],
                    [1, date('Y-m-d H:i:s', $tNow + 5 * $nDaySec)],
                    [1, date('Y-m-d H:i:s', $tNow + 7 * $nDaySec)],
                ],
            ],
        ];
    }


}