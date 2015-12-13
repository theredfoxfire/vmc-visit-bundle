<?php

namespace Vmc\VisitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vmc\VisitBundle\Model\VisitInterface;

/**
 * Visit
 */
class Visit implements VisitInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $patient_id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $keluhan;

    /**
     * @var string
     */
    private $pemeriksaan_fisik;

    /**
     * @var string
     */
    private $diagnosis;

    /**
     * @var string
     */
    private $tindakan;

    /**
     * @var string
     */
    private $obat;

    /**
     * @var string
     */
    private $biaya;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set patientId
     *
     * @param integer $patientId
     *
     * @return Visit
     */
    public function setPatientId($patientId)
    {
        $this->patient_id = $patientId;

        return $this;
    }

    /**
     * Get patientId
     *
     * @return integer
     */
    public function getPatientId()
    {
        return $this->patient_id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Visit
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set keluhan
     *
     * @param string $keluhan
     *
     * @return Visit
     */
    public function setKeluhan($keluhan)
    {
        $this->keluhan = $keluhan;

        return $this;
    }

    /**
     * Get keluhan
     *
     * @return string
     */
    public function getKeluhan()
    {
        return $this->keluhan;
    }

    /**
     * Set pemeriksaanFisik
     *
     * @param string $pemeriksaanFisik
     *
     * @return Visit
     */
    public function setPemeriksaanFisik($pemeriksaanFisik)
    {
        $this->pemeriksaan_fisik = $pemeriksaanFisik;

        return $this;
    }

    /**
     * Get pemeriksaanFisik
     *
     * @return string
     */
    public function getPemeriksaanFisik()
    {
        return $this->pemeriksaan_fisik;
    }

    /**
     * Set diagnosis
     *
     * @param string $diagnosis
     *
     * @return Visit
     */
    public function setDiagnosis($diagnosis)
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    /**
     * Get diagnosis
     *
     * @return string
     */
    public function getDiagnosis()
    {
        return $this->diagnosis;
    }

    /**
     * Set tindakan
     *
     * @param string $tindakan
     *
     * @return Visit
     */
    public function setTindakan($tindakan)
    {
        $this->tindakan = $tindakan;

        return $this;
    }

    /**
     * Get tindakan
     *
     * @return string
     */
    public function getTindakan()
    {
        return $this->tindakan;
    }

    /**
     * Set obat
     *
     * @param string $obat
     *
     * @return Visit
     */
    public function setObat($obat)
    {
        $this->obat = $obat;

        return $this;
    }

    /**
     * Get obat
     *
     * @return string
     */
    public function getObat()
    {
        return $this->obat;
    }

    /**
     * Set biaya
     *
     * @param string $biaya
     *
     * @return Visit
     */
    public function setBiaya($biaya)
    {
        $this->biaya = $biaya;

        return $this;
    }

    /**
     * Get biaya
     *
     * @return string
     */
    public function getBiaya()
    {
        return $this->biaya;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Visit
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}

