<?php declare(strict_types=1);

/**
 * @copyright (c) 2014-present brian ridley
 * @author brian ridley <ptlis@ptlis.net>
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ptlis\DiffParser\Integration\Test\Parse\Git;

use PHPUnit\Framework\TestCase;
use ptlis\DiffParser\File;
use ptlis\DiffParser\Hunk;
use ptlis\DiffParser\Line;
use ptlis\DiffParser\Parse\UnifiedDiffParser;
use ptlis\DiffParser\Parse\UnifiedDiffTokenizer;
use ptlis\DiffParser\Parse\GitDiffNormalizer;

final class DiffParserAddTest extends TestCase
{
    public function testParseCount(): void
    {
        $parser = new UnifiedDiffParser(
            new UnifiedDiffTokenizer(
                new GitDiffNormalizer()
            )
        );

        $data = file(__DIR__ . '/data/diff_add', FILE_IGNORE_NEW_LINES);

        $diff = $parser->parse($data);

        $this->assertInstanceOf('ptlis\DiffParser\Changeset', $diff);
        $this->assertEquals(1, count($diff->getFiles()));
    }

    public function testFileAdd(): void
    {
        $parser = new UnifiedDiffParser(
            new UnifiedDiffTokenizer(
                new GitDiffNormalizer()
            )
        );

        $data = file(__DIR__ . '/data/diff_add', FILE_IGNORE_NEW_LINES);

        $diff = $parser->parse($data);
        $fileList = $diff->getFiles();

        $this->assertEquals(1, count($fileList[0]->getHunks()));

        $file = new File(
            '',
            'README.md',
            File::CREATED,
            [
                new Hunk(
                    0,
                    0,
                    1,
                    1,
                    [
                        new Line(-1, 1, Line::ADDED, '## Test')
                    ]
                )
            ]
        );

        $this->assertEquals($file, $fileList[0]);
    }
}
