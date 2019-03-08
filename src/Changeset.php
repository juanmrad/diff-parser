<?php declare(strict_types=1);

/** *
 * @copyright (c) 2014-present brian ridley
 * @author brian ridley <ptlis@ptlis.net>
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ptlis\DiffParser;

/**
 * Class storing data for a single changeset.
 */
final class Changeset
{
    /** @var File[] Array of changed files in this diff. */
    private $changedFileList;


    /**
     * Constructor.
     *
     * @param File[] $changedFileList
     */
    public function __construct(array $changedFileList)
    {
        $this->changedFileList = $changedFileList;
    }

    /**
     * Get an array of changed files.
     *
     * @return File[]
     */
    public function getFiles(): array
    {
        return $this->changedFileList;
    }

    /**
     * Get the string representation of the diff.
     */
    public function __toString(): string
    {
        return implode(PHP_EOL, $this->changedFileList);
    }
}
