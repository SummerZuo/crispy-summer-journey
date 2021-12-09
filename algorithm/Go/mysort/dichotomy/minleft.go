package dichotomy

func MinLeft(sortedArr []int, num int) int {
	L := 0
	R := len(sortedArr) - 1
	var index int
	for L <= R {
		Mid := L + ((R - L) >> 1)
		if sortedArr[Mid] >= num {
			index = Mid
			R = Mid - 1
		} else {
			L = Mid + 1
		}
	}
	return index
}
