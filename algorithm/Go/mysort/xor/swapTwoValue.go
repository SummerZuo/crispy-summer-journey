package xor

func Swap(a, b int) {
	a = a ^ b
	b = a ^ b
	a = a ^ b
}
