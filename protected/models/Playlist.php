<?php

/**
 * This is the model class for table "Playlist".
 *
 * The followings are the available columns in table 'Playlist':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $mediaType
 * @property string $creationDate
 * @property string $lastUpdate
 * @property integer $isActive
 * @property integer $image_id
 * @property integer $artist_id
 *
 * The followings are the available model relations:
 * @property Artist $artist
 * @property Image $image
 * @property PlaylistMedia[] $playlistMedias
 */
class Playlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Playlist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, lastUpdate, artist_id', 'required'),
			array('isActive, image_id, artist_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>80),
			array('description', 'length', 'max'=>300),
			array('mediaType', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, mediaType, creationDate, lastUpdate, isActive, image_id, artist_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'artist' => array(self::BELONGS_TO, 'Artist', 'artist_id'),
			'image' => array(self::BELONGS_TO, 'Image', 'image_id'),
			'playlistMedias' => array(self::HAS_MANY, 'PlaylistMedia', 'playlist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'mediaType' => 'Media Type',
			'creationDate' => 'Creation Date',
			'lastUpdate' => 'Last Update',
			'isActive' => 'Is Active',
			'image_id' => 'Image',
			'artist_id' => 'Artist',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('mediaType',$this->mediaType,true);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('image_id',$this->image_id);
		$criteria->compare('artist_id',$this->artist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}