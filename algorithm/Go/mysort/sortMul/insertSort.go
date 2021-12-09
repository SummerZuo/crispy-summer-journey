package sortMul

// 插入排序
// 思路：每次都保证前i项顺序
// 时间复杂度 O(N^2) （O表示最差时间复杂度， O(1)+O(2)+...+O(N) = O(N^2)）
// 空间复杂度 O(N)
func InsertSort(arr []int) {
	for i := 1; i < len(arr); i++ {
		for j := i - 1; j >= 0 && arr[j] > arr[j+1]; j-- {
			arr[j], arr[j+1] = arr[j+1], arr[j]
		}
	}
}
