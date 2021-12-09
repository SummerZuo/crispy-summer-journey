package xor

// 偶数次的数异或之后为0
// 所以最后只剩下一个数异或上0 ==> 需要的结果
// 比hash表要好，额外空间复杂度为O(1)
func PrintOddTimesNum(arr []int) int {
	eor := 0
	for i := 0; i < len(arr); i++ {
		eor ^= arr[i]
	}
	return eor
}
