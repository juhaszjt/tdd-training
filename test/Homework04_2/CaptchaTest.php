<?php/** * Created by PhpStorm. * User: jani * Date: 19/10/2014 * Time: 22:32 */namespace FraudSystem\Test\Homework04_2;use FraudSystem\Homework04_2\Captcha;class CaptchaTest extends \PHPUnit_Framework_TestCase{    private $captcha;    public function setUp()    {        $this->captcha = new Captcha();    }    public function tearDown()    {        unset($this->captcha);    }    public function testCaptchaIsActiveVariableExistsAndType()    {        $this->assertAttributeInternalType('boolean', 'captchaIsActive', $this->captcha);    }    public function testCaptchaIsActiveVariableDefaultValue()    {        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());    }    public function testSetCaptchaIsActiveVariable()    {        $this->captcha->setCaptchaToActive();        $this->assertEquals(true, $this->captcha->isCaptchaIsActive());    }		public function testResetCaptcha()    {        $this->captcha->setCaptchaToActive();		        $this->captcha->resetCaptcha();        $this->assertEquals(false, $this->captcha->isCaptchaIsActive());    }} 