<?php

class Subscriber {
	public function callback() {
		throw new Exception();
	}

	public function second_callback() {
		throw new ArithmeticError();
	}
}