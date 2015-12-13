<?php

namespace Vmc\VisitBundle\Model;

Interface VisitInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set patientId
     *
     * @param integer $patientId
     *
     * @return Visit
     */
    public function setPatientId($patientId);

    /**
     * Get patientId
     *
     * @return integer
     */
    public function getPatientId();

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Visit
     */
    public function setDate($date);

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Set keluhan
     *
     * @param string $keluhan
     *
     * @return Visit
     */
    public function setKeluhan($keluhan);

    /**
     * Get keluhan
     *
     * @return string
     */
    public function getKeluhan();

    /**
     * Set pemeriksaanFisik
     *
     * @param string $pemeriksaanFisik
     *
     * @return Visit
     */
    public function setPemeriksaanFisik($pemeriksaanFisik);

    /**
     * Get pemeriksaanFisik
     *
     * @return string
     */
    public function getPemeriksaanFisik();

    /**
     * Set diagnosis
     *
     * @param string $diagnosis
     *
     * @return Visit
     */
    public function setDiagnosis($diagnosis);

    /**
     * Get diagnosis
     *
     * @return string
     */
    public function getDiagnosis();

    /**
     * Set tindakan
     *
     * @param string $tindakan
     *
     * @return Visit
     */
    public function setTindakan($tindakan);

    /**
     * Get tindakan
     *
     * @return string
     */
    public function getTindakan();

    /**
     * Set obat
     *
     * @param string $obat
     *
     * @return Visit
     */
    public function setObat($obat);

    /**
     * Get obat
     *
     * @return string
     */
    public function getObat();

    /**
     * Set biaya
     *
     * @param string $biaya
     *
     * @return Visit
     */
    public function setBiaya($biaya);

    /**
     * Get biaya
     *
     * @return string
     */
    public function getBiaya();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Visit
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
