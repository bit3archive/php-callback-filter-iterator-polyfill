<?php

/**
 * RecursiveCallbackFilterIterator polyfill for old PHP versions.
 *
 * Based on the implementation by a dot belloundja at gmail dot com
 * http://de2.php.net/manual/en/class.recursivecallbackfilteriterator.php#110974
 */
class RecursiveCallbackFilterIterator extends RecursiveFilterIterator
{

	/**
	 * @var callable
	 */
	protected $callback;

	public function __construct(RecursiveIterator $iterator, $callback)
	{
		$this->callback = $callback;
		parent::__construct($iterator);
	}

	public function accept()
	{
		return call_user_func(
			$this->callback,
			parent::current(),
			parent::key(),
			parent::getInnerIterator()
		);
	}

	public function getChildren()
	{
		return new self($this->getInnerIterator()->getChildren(), $this->callback);
	}
}