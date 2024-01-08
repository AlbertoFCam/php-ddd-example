<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;
use Override;

final class CourseSearchTest extends CoursesModuleUnitTestCase
{
	$finder = new CourseFinder($this->repository());
	$course = CourseMother::create();

	/** @test */
	public function it_should_find_an_existing_course(): void
	{
		$this->shouldSearch($course->id(), $course);
		$courseFound = $finder->__invoke($course->id());

		$this->assertSimilar($course, $courseFound);
	}

	/** @test */
	public function it_should_throw_an_exception_course_not_exist(): void
	{
		$this->expectedException(CourseNotExist::class);

		$this->shouldSearch($course->id(), null);
		$finder->__invoke($course);
	}
}
