<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * 导出模型
 * Class SupplierExport
 * @package app\models
 * @author wangwentao
 * @property array $ids
 */
class SupplierExport extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ids'], 'required'],
        ];
    }

    public function attributes()
    {
        return ArrayHelper::merge(parent::attributes(), ['ids']);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * 导出数据
     * @param $params
     * @throws \Exception
     * @author wangwentao
     */
    public function export(array $params)
    {
        $this->load($params, '');
        if (!$this->validate()) {
            throw new \Exception(sprintf("导出失败:参数错误:%s", current($this->getFirstErrors())));
        }
        $ids = explode(',', $this->ids);
        $query = Supplier::find();

        $data = $query->where(['id' => $ids])->select(['id', 'name', 'code', 't_status'])->asArray()->all();
        $title = ['ID', '名称', 'Code', '状态'];
        $file = '供应商列表导出' . date('YmdHis') . '.csv';
        $content = '';
        foreach ($data as $item) {
            $content .= "\n" . implode(',', array_values($item));
        }
        return $this->csvExport($file, implode(',', $title), $content);
    }

    /**
     * 导出csv
     * @param $file
     * @param $title
     * @param $data
     * @author wangwentao
     */
    public function csvExport($file, $title, $data)
    {
        header("Content-Disposition:attachment;filename=" . $file);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        $wrstr = $title;

        $wrstr .= $data;

        $wrstr = iconv("utf-8", "GBK//ignore", $wrstr);

        echo $wrstr;

        die;

    }
}