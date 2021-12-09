package sortMul

// 冒泡排序
// 相邻元素之间进行对比,将最大的元素放到队尾
// 两层循环，第一层从最末尾开始，第二层循环每次都从0开始，end为第一层的值
// 时间复杂度 O(N^2)
// 空间复杂度 O(N)
func BubbleSort(arr []int) {
	length := len(arr)
	if length < 2 {
		return
	}
	for i := length - 1; i >= 0; i-- {
		for j := 0; j < i; j++ {
			if arr[j] > arr[j+1] {
				arr[j], arr[j+1] = arr[j+1], arr[j]
			}
		}
	}
}
