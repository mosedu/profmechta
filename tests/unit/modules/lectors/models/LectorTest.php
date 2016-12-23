<?php
namespace modules\lectors\models;

use app\modules\lectors\models\Lector;

class LectorTest extends \Codeception\Test\Unit
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
    public function testErrorValidationEmptyModel()
    {
        $ob = new Lector();
        $aErrField = ['lec_fam', 'lec_profession', ]; // 'lec_description',
        asort($aErrField);

        $this->assertFalse($ob->validate(), 'Empty model should not be valid');

        $aObError = array_keys($ob->getErrors());
        asort($aObError);

        $this->assertTrue(count($aObError) == count($aErrField), 'Model should has ' . count($aErrField) . ' errors: ' . print_r($ob->getErrors(), true));
        foreach($aErrField As $k => $v) {
            $this->assertTrue(in_array($v, $aObError), 'Model should has error in field ' . $v);
        }
    }

    /**
     * @dataProvider errorLectorProvider
     */
    public function testErrorValidationPoorModel($fam, $prof, $desc)
    {
        $ob = new Lector();
        $ob->lec_fam = $fam;
        $ob->lec_profession = $prof;
        $ob->lec_description = $desc;

        $this->assertFalse($ob->validate(), 'Poor filled model should not be valid');
    }

    /**
     * @dataProvider okLectorProvider
     */
    public function testOkValidationFilledModel($fam, $prof, $desc)
    {
        $ob = new Lector();
        $ob->lec_fam = $fam;
        $ob->lec_profession = $prof;
        $ob->lec_description = $desc;

        $this->assertTrue($ob->validate(), 'Ok filled model should be valid');
    }

    /**
     * @dataProvider okLectorProvider
     */
    public function testSaveFilledModel($fam, $prof, $desc)
    {
        $ob = new Lector();
        $ob->lec_fam = $fam;
        $ob->lec_profession = $prof;
        $ob->lec_description = $desc;

        $this->assertTrue($ob->save(), 'Ok filled model should be saved');
        $this->assertFalse(empty($ob->lec_created), 'Saved model should has created date');
        $this->assertFalse(empty($ob->lec_key), 'Saved model should has API key');
        $this->assertFalse(empty($ob->lec_pass), 'Saved model should has password');
        $this->assertTrue($ob->lec_active == Lector::LECTOR_STATE_ACTIVE, 'Saved model should active = ' . Lector::LECTOR_STATE_ACTIVE);
    }

    public function errorLectorProvider()
    {
        return [
            'EmptyProfession' => ['Fam', '', 'Description'],
            'EmptyFam' => ['', 'Profession', 'Description'],
//            'EmptyDescription' => ['Fam', 'Profession', ''],
            'TooLongProfession' => ['Fam', 'Profession too long 1234567890 1234567890 1234567890 1234567890 1234567890 1234567890 1234567890', 'Description'],
        ];
    }

    public function okLectorProvider()
    {
        return [
            'Correct' => ['Fam', 'Profession', 'Description'],
        ];
    }

}