package bitOperation

// 数组中有一个数出现了k次，其他数出现了m次，m > 1 且 k < m
//找出出现了k次的数

// 分析：申请一个32位的数组t，把arr数组中的数转化为二进制，并将对应位置为1的数累加到数组t中，得到t中i位置出现1的数量
// 2.若此时发现i位置上的数都为出现了m次的数，则 m % a[i] = 0，若 != 0，则表示出现了出现k次的数（k<m的条件在这里就用到了），将i中为1的位置转换为十进制的值，为结果

func FindK(arr []int, k int, m int) int {
	// 由于go中int类型表示32位，故申请32位空间大小的数组
	var t [32]int
	// 将数组中每个元素每一位都放入到t数组中
	for i := 0; i < len(arr); i++ {
		for j := 0; j < 32; j++ {
			t[j] += (arr[i] >> j) & 1
		}
	}
	ans := 0
	for i := 0; i < 32; i++ {
		if t[i]%m != 0 {
			ans |= 1 << i
		}
	}
	return ans
}
