<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Phone;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    /** @test */
    public function success()
    {
        $phone = '380999922222';

        $obj = new Phone($phone);

        $this->assertEquals($phone, $obj);
    }

    /** @test */
    public function format_with_plus()
    {
        $phone = '380999922222';
        $phoneWithPlus = '+380999922222';

        $obj = new Phone($phone);

        $this->assertEquals($phoneWithPlus, $obj->withPlus());
        $this->assertNotEquals($phone, $obj->withPlus());
    }

    /** @test */
    public function success_clear()
    {
        $phone = '+38(099)9922222';
        $phoneClear = '380999922222';

        $obj = new Phone($phone);

        $this->assertNotEquals($phone, $obj);
        $this->assertEquals($phoneClear, $obj);
    }

    /** @test */
    public function wrong_long()
    {
        $this->expectException(\InvalidArgumentException::class);

        $phone = new Phone('+38(099)9922222777777777777777777777777777');
    }

    /** @test */
    public function not_phone()
    {
        $this->expectException(\InvalidArgumentException::class);

        $phone = new Phone('not phone');
    }

    /** @test */
    public function compare_same_objects_success()
    {
        $phoneString = '+380991234567';
        $phone1 = new Phone($phoneString);
        $phone2 = new Phone($phoneString);

        $this->assertTrue($phone1->compare($phone2));
    }

    /** @test */
    public function compare_same_objects_success_pretty()
    {
        $phoneString = '+380991234567';
        $phoneStringPretty = '380991234567';
        $phone1 = new Phone($phoneString);
        $phone2 = new Phone($phoneStringPretty);

        $this->assertTrue($phone1->compare($phone2));
    }

    /** @test */
    public function compare_not_equals_object_fail()
    {
        $phone1 = new Phone('+380991234567');
        $phone2 = new Phone('+380991234568');

        $this->assertFalse($phone1->compare($phone2));
    }

    /** @test */
    public function has_exception_when_compare_not_same_objects()
    {
        $phone = new Phone('+380991234567');
        $object = new \stdClass();

        $this->expectException(\TypeError::class);

        $phone->compare($object);
    }
}
