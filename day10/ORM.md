## 概念
1. `Object Relation Mapping`：对象关系映射，采用面向对象的方式来访问、操作数据库，ORM中包含了对数据库的底层操作.

## Yii中设计优美的地方

## Laravel中设计优美的地方
1. Model中没有继承其他类，采用`trait`的方式来给class添加功能
	继承越多，代码效率越低，阅读性更差
	通过trait的方式来加载其他功能，就类似于一个可插拔的插件一样，非常方便，且对原有类代码破坏性少


## 扩充知识
1. 静态方法中怎么调用普通方法
eg
```php
	return (new static)->newQuery();
```

2. 获取class中的trait
```php
	class_uses()
```
3. 获取传入函数的参数
```php
	func_get_args()
```


## Q
1. cursor是怎么实现的

## 对比
1. laravel使用的分批加载数据的方式与Yii的区别，哪个性能更好？

2. 游标对比