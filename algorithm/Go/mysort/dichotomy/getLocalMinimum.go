package dichotomy

// 找一个局部最小
// 条件1：相邻元素不相等（保证图像的曲线）
// 条件2：局部最小--值小于左右相邻的元素

// 若 arr[mid-1] < arr[mid] 值在左侧，
// 若 arr[mid] > arr[mid+1] 值在右侧，
// 否则 返回arr[mid]
func getLocalMinimum(arr []int) int {
	length := len(arr)
	// 边界条件
	if arr[0] < arr[1] {
		return 0
	}

	if arr[length-1] < arr[length-2] {
		return arr[length-1]
	}

	L := 1
	R := length - 2
	for L < R {
		Mid := L + ((R - L) >> 1)
		if arr[Mid-1] < arr[Mid] {
			R = Mid - 1
		} else if arr[Mid] > arr[Mid+1] {
			L = Mid + 1
		} else {
			return Mid
		}
	}
	return L
}
