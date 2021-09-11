<?php

namespace Tests\Unit\Commands\Tag;

use App\Commands\Tag\Create\Command;
use App\Commands\Tag\Create\Handler;
use App\Models\Tag\Tag;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    public function fill_command()
    {
        $data = $this->data();

        $command = new Command($data);

        $this->assertEquals($data['name'], $command->name);
        $this->assertEquals($data['type'], $command->type);
        $this->assertEquals($data['is_base'], $command->is_base);
        $this->assertNull($command->parent_id);
    }

    /** @test */
    public function fill_command_without_base()
    {
        $data = $this->data();
        unset($data['is_base']);

        $command = new Command($data);

        $this->assertEquals($data['name'], $command->name);
        $this->assertEquals($data['type'], $command->type);
        $this->assertFalse($command->is_base);
        $this->assertNull($command->parent_id);
    }

    /** @test */
    public function fill_command_with_parent()
    {
        $data = $this->data();
        $data['parent_id'] = 3;

        $command = new Command($data);

        $this->assertEquals($data['name'], $command->name);
        $this->assertEquals($data['type'], $command->type);
        $this->assertTrue($command->is_base);
        $this->assertEquals($data['parent_id'], $command->parent_id);
    }

    /** @test */
    public function create_success()
    {
        $command = new Command($this->data());

        $tag = (new Handler())->handler($command);

        $this->assertTrue($tag instanceof Tag);
        $this->assertEquals($tag->name, $command->name);
        $this->assertEquals($tag->type, $command->type);
        $this->assertEquals($tag->is_base, $command->is_base);
        $this->assertEquals($tag->parent_id, $command->parent_id);
    }

    public function data()
    {
        return [
            'name' => 'test',
            'type' => Tag::TYPE_COMING,
            'is_base' => true,
        ];
    }
}
