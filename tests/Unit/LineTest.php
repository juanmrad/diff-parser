<?php declare(strict_types=1);

/**
 * @copyright (c) 2014-present brian ridley
 * @author brian ridley <ptlis@ptlis.net>
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ptlis\DiffParser\Test\Unit;

use PHPUnit\Framework\TestCase;
use ptlis\DiffParser\Line;

/**
 * @covers \ptlis\DiffParser\Line
 */
final class LineTest extends TestCase
{
    public function testLineUnchanged(): void
    {
        $line = new Line(
            5,
            6,
            Line::UNCHANGED,
            'bob'
        );

        $this->assertEquals(5, $line->getOriginalLineNo());
        $this->assertEquals(6, $line->getNewLineNo());
        $this->assertEquals(Line::UNCHANGED, $line->getOperation());
        $this->assertEquals('bob', $line->getContent());
        $this->assertEquals(' bob', $line->__toString());
    }

    public function testLineRemoved(): void
    {
        $line = new Line(
            9,
            Line::LINE_NOT_PRESENT,
            Line::REMOVED,
            'some stuff'
        );

        $this->assertEquals(9, $line->getOriginalLineNo());
        $this->assertEquals(-1, $line->getNewLineNo());
        $this->assertEquals(Line::REMOVED, $line->getOperation());
        $this->assertEquals('some stuff', $line->getContent());
        $this->assertEquals('-some stuff', $line->__toString());
    }

    public function testLineAdded(): void
    {
        $line = new Line(
            Line::LINE_NOT_PRESENT,
            11,
            Line::ADDED,
            'really good comment'
        );

        $this->assertEquals(-1, $line->getOriginalLineNo());
        $this->assertEquals(11, $line->getNewLineNo());
        $this->assertEquals(Line::ADDED, $line->getOperation());
        $this->assertEquals('really good comment', $line->getContent());
        $this->assertEquals('+really good comment', $line->__toString());
    }
}
