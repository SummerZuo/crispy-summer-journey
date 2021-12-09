package dichotomy

// 判断数据是否存在与数组中
// L Mid R
// Mid > num，在左边 L Mid-1
// Mid < num,在右边 Mid+1 R
func Exists(sortedArr []int, num int) bool {
	L := 0
	R := len(sortedArr) - 1
	for L < R {
		Mid := L + ((R - L) >> 1)
		if sortedArr[Mid] > num {
			R = Mid - 1
		} else if sortedArr[Mid] < num {
			L = Mid + 1
		} else {
			return true
		}
	}

	return sortedArr[L] == num
}
