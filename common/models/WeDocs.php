<?php

namespace common\models;

use common\models\DocumentUpload;
use Yii;

/**
 * This is the model class for table "weDocs".
 *
 * @property int $id
 * @property string $docNameReal
 * @property string $docNameView
 * @property string $itemImage
 * @property string $itemDescription
 *
 * @property $documentLink
 * @property $images
 */
class WeDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weDocs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docNameView'], 'required'],
            [['itemDescription'], 'string'],
            [['docNameReal', 'docNameView', 'itemImage'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docNameReal' => 'Документ',
            'docNameView' => 'Выводимое имя',
            'itemImage' => 'Изображение',
            'itemDescription' => 'Описание',
        ];
    }

    public function saveDocument($fileName)
    {
        $this->docNameReal = $fileName;
        return $this->save(false);
    }

    public function getDocumentLink()
    {
        return ($this->docNameReal)
            ? '/uploads/documents/' . $this->docNameReal
            : '#';
    }

    public function deleteDocument()
    {
        $docUploadModel = new DocumentUpload();

        $docUploadModel->deleteCurrentDocument($this->docNameReal);
    }

    /**
     * @param $fileName
     * @return bool
     */
    public function saveImage($fileName)
    {
        $this->itemImage = $fileName;

        return $this->save(false);
    }

    /**
     * @param $folder
     * @return array
     */
    public function getImages($folder)
    {
        return [
            'image' => ($this->itemImage) ? '/uploads/images/' . $folder . '/' . $this->itemImage : '/no_image.png',
            'thumb_image' => ($this->itemImage) ? '/uploads/images/' . $folder . '/' . 'thumb_' . $this->itemImage : '/no_image.png',
        ];
    }

    /**
     * @throws \yii\base\Exception
     */
    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();

        $imageUploadModel->deleteCurrentImage($this->itemImage);
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeDelete()
    {
        $this->deleteDocument();
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
