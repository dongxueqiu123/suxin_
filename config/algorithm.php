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
            ],
            'cubicSplineInterpolation' => [
                'name' => '三次样条插值',
            ],
            'leastSquareFitting' => [
                'name' => '最小二乘拟合',
            ],
        ]
    ],
];