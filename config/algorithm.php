<?php
return [
    'interpolationAndFitting'=>[
        'name'=>'插值与拟合',
        'classify'=>[
            'newtonInterpolation' => [
                'name' => '牛顿插值',
                'info' => '对于给定的 N+1 个点，可以通过牛顿插值法求取经过这些点的N 次多项式。',
                'outPutInfo' => 'N次多项式',
                'inPutInfo'  => 'N+1个观测点',
                'outPutType' => 'line',
                'inPutType' => 'scatter'
            ],
            'cubicSplineInterpolation' => [
                'name' => '三次样条插值',
                'info' => '三次样条插值法对每个插值区间用三次多项式进行近似，并且保证区间端点插值多项式与其一阶导数均连续',
                'outPutInfo' => '三次样条插值函数 y = f(x)',
                'inPutInfo'  => 'N个观测点',
                'outPutType' => 'line',
                'inPutType' => 'scatter'
            ],
            'leastSquareFitting' => [
                'name' => '最小二乘拟合',
                'info' => '给定观测值求其所遵从的函数关系时需要进行曲线拟合，最常用的一类拟合方法就是最小二乘拟合，该方法以观测数据与待拟函数之间的均方误差为准则求取拟合参数',
                'outPutInfo' => '拟合函数 y = f(x)',
                'inPutInfo'  => 'N个观测点',
                'outPutType' => 'line',
                'inPutType' => 'scatter'
            ],
        ]
    ],
    'classical'=>[
        'name'=>'经典谱估计方法',
        'classify'=>[
            'periodogram' => [
                'name' => '周期图法谱估计',
                'info' => '周期图法是一种信号功率谱密度估计方法。由于序列x(n)的离散傅里叶变换X()具有周期性，因而这种功率谱也具有周期性，常称为周期图',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'bartlett' => [
                'name' => 'Bartlett 法谱估计',
                'info' => '一种经典法谱估计算法，先将数据分成L段，加矩形窗之后分别求出每一段的周期图法，再求平均',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'welch' => [
                'name' => 'Welch 法谱估计',
                'info' => '对Bartlett法的改进，改进之一是可以允许数据的重叠；改进之二是可以允许使用除矩形窗之外的窗，例如使用汉宁窗或汉明窗',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'bt' => [
                'name' => 'BT 法谱估计',
                'info' => '首先计算截断信号的线性自相关，然后求其离散傅里叶变换，取其模值，归一化，并取以10为底的对数然后乘以10，绘制归一化后的功率谱图',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],
    'paramet'=>[
        'name'=>'参数化谱估计方法',
        'classify'=>[
            'yulewalker' => [
                'name' => 'Yule-Walker 谱估计方法',
                'info' => 'Yule-Walker 谱估计方法是描述自回归序列参数与其协方差函数之间关系的一种谱估计算法',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'burg' => [
                'name' => 'Burg 谱估计方法',
                'info' => 'Burg 谱估计方法一种直接由已知的时间信号序列计算功率谱估计值的递推算法',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],
    'eigenanal'=>[
        'name'=>'特征分析谱估计方法',
        'classify'=>[
            'capon' => [
                'name' => 'Capon 谱估计方法',
                'info' => 'Capon 法有时也被称为最大似然（ML）估计器，在具有任意空间特性的高斯白噪声存在的情况下，对于任意的 θ ， PCapon (θ )是来自方向θ 的信号功率的最大似然估计',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'music' => [
                'name' => 'MUSIC 谱估计方法',
                'info' => '多重信号分类，是一类空间谱估计算法。其思想是利用接收数据的协方差矩阵(Rx)进行特征分解，分离出信号子空间和噪声子空间，利用信号方向向量与噪声子空间的正交性来构成空间扫描谱，进行全域搜索谱峰，从而实现信号的参数估计',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'pisarenko' => [
                'name' => 'Pisarenko 谱估计方法',
                'info' => '算法选取噪声子空间中最小特征值对应的特征向量作为阵列导向矢量的投影矢量，由于只利用了最小特征值对应的特征向量，其谱分辨力较MUSIC 算法有所提高，但是其空间谱曲线容易产生伪峰',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'esprit' => [
                'name' => 'ESPRIT 谱估计方法',
                'info' => 'ESPRIT 谱估计方法属于信号子空间算法，它是利用子阵间信号子空间的旋转不变性来求解的',
                'outPutInfo' => '谱估计后的数据',
                'inPutInfo'  => '观测数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],
    'adaptiveFilters'=>[
        'name'=>'自适应滤波器',
        'classify'=>[
            'wiener' => [
                'name' => 'Wiener滤波器',
                'info' => '维纳滤波器一种基于最小均方误差准则、对平稳过程的最优估计器，可用于提取被平稳噪声所污染的信号',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'lms' => [
                'name' => 'LMS滤波器',
                'info' => 'LMS是最常用的自适应滤波算法，它以当前的误差代替期望误差，通过梯度下降方法调整滤波器的系数，从而跟踪输入信号或系统的变化，达到自适应的目的',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
            'rls' => [
                'name' => 'RLS滤波器',
                'info' => 'RLS算法与LMS算法不同，不是最小均方意义下的自适应滤波器，而是通过递归的方法求解以误差信号为代价函数的加权最小二乘问题，从而更新滤波器的系数',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],
/*    'timeFrequencyAnalysis'=>[
        'name'=>'时频分析',
        'classify'=>[
            'windowFourierTransform' => [
                'name' => '加窗Fourier变换',
                'info' => '通过对信号与时频原子作内积，将信号从时域信号变换到时频域，实现了时频局部化的分析特性，克服了 Fourier 变换全局性的缺点',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],*/
    'waveletTransform'=>[
        'name'=>'小波变换',
        'classify'=>[
            'discrete' => [
                'name' => '离散小波变换',
                'info' => '离散小波变换是对基本小波的尺度和平移进行离散化',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'line'
            ],
        ]
    ],
/*    'adaptiveFilters'=>[
        'name'=>'自适应滤波器',
        'classify'=>[
            'wiener' => [
                'name' => 'Wiener滤波器 ',
                'info' => '维纳滤波器一种基于最小均方误差准则、对平稳过程的最优估计器，可用于提取被平稳噪声所污染的信号',
                'outPutInfo' => '滤波后的数据',
                'inPutInfo'  => '原始数据',
                'outPutType' => 'line',
                'inPutType' => 'scatter'
            ],
        ]
    ],*/

];