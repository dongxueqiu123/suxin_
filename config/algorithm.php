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
    'powerSpectrumEstimation'=>[
        'name'=>'功率谱估计',
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