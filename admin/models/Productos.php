<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property integer $id
 * @property integer $categoria_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $imagen
 *
 * @property Categorias $categoria
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria_id', 'nombre', 'descripcion', 'imagen'], 'required'],
            [['categoria_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['descripcion'], 'string', 'max' => 2500],
            [['imagen'], 'string', 'max' => 510]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria_id' => 'Categoria ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }
}
