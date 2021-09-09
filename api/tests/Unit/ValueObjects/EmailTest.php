<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Email;
use InvalidArgumentException;
use stdClass;
use Tests\TestCase;
use TypeError;

class EmailTest extends TestCase
{
    /** @test */
    public function success()
    {
        $emailString = 'valid.email@example.com';
        $email = new Email($emailString);

        $this->assertEquals($emailString, $email);
    }

    /** @test */
    public function has_exception_when_create_by_not_valid_email_string()
    {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('not.valid.email@example');
    }

    /** @test */
    public function compare_same_objects_success()
    {
        $emailString = 'valid.email@example.com';
        $email1 = new Email($emailString);
        $email2 = new Email($emailString);

        $this->assertTrue($email1->compare($email2));
    }

    /** @test */
    public function compare_not_equals_object_fail()
    {
        $email1 = new Email('valid.email1@example.com');
        $email2 = new Email('valid.email2@example.com');

        $this->assertFalse($email1->compare($email2));
    }

    /** @test */
    public function has_exception_when_compare_not_same_objects()
    {
        $email = new Email('valid.email1@example.com');
        $object = new stdClass();

        $this->expectException(TypeError::class);

        $email->compare($object);
    }
}
