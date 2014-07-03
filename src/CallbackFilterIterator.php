<?php

/**
 * CallbackFilterIterator polyfill for old PHP versions.
 *
 * Based on the implementation by dave1010 at gmail dot com
 * http://www.php.net/manual/en/class.callbackfilteriterator.php#108803
 */
class CallbackFilterIterator extends FilterIterator
{

	/**
	 * @var callable
	 */
	protected $callback;

	/**
	 * {@inheritdoc}
	 *
	 * @param Iterator $iterator
	 * @param callable $callback
	 */
	public function __construct(Iterator $iterator, $callback = null)
	{
		$this->callback = $callback;
		parent::__construct($iterator);
	}

	/**
	 * {@inheritdoc}
	 */
	public function accept()
	{
		return call_user_func(
			$this->callback,
			$this->current(),
			$this->key(),
			$this->getInnerIterator()
		);
	}
}
