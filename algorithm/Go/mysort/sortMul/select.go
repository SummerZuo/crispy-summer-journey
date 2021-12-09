package sortMul

// 选择排序
// 核心思路：外层循环n次，每次都选一个最小值放到i位置
// 时间复杂度 O(N^2)
// 空间复杂度 O(N)
// a, b = b, a
func SelectSort(arr []int) {
	if len(arr) < 2 {
		return
	}
	for i := 0; i < len(arr)-1; i++ {
		// i与之后的元素进行比较
		for j := i + 1; j < len(arr); j++ {
			if arr[i] > arr[j] {
				arr[i], arr[j] = arr[j], arr[i]
			}
		}
	}
}
