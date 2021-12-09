package main_test

import "testing"

// 交换两个值
func TestChangeTwoValue(t *testing.T) {
	// 交换两个值
	a := 100
	b := 30

	a = a ^ b
	b = a ^ b
	a = a ^ b
	println(a, b)
}

//
