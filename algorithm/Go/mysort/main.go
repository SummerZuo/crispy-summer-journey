package main

import (
	"fmt"
	"mysort/bitOperation"
	"mysort/xor"
)

func main() {
	//arr := []int{3, 7, 8, 3, 6, 8, 2, 5, 1, 8, 4, 9}
	//fmt.Println(arr)
	//sortMul.InsertSort(arr)
	//fmt.Println(arr)

	//sortMul.InsertSort(arr)
	//fmt.Println(arr)
	// 1.有序数组，找某个数是否存在
	//ret := dichotomy.Exists(arr, 9)
	//fmt.Println(ret)
	// 2.有序数组，找>=某个数最左侧的位置
	//ret := dichotomy.MinLeft(arr, 9)
	//fmt.Println(ret)
	// 3.局部最小（相邻元素不想等， 左右均大于它）

	// 找出出现基数词的数
	xorArr := []int{1, 2, 3, 1, 1, 1, 2, 3, 3, 4, 3, 5, 4}
	fmt.Println(xor.PrintOddTimesNum(xorArr))

	// 数组中有两个出现奇数次的数，怎么找出来

	// 找出一个数组中出现了k次的数
	findKArr := []int{1, 3, 4, 1, 4, 1, 4, 1, 3, 3, 3, 4, 6, 6, 6}
	fmt.Println(bitOperation.FindK(findKArr, 3, 4))
}
