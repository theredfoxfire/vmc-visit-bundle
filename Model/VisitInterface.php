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
     * Set noVisit
     *
     * @param string $noVisit
     *
     * @return Visit
     */
    public function setNoVisit($noVisit);

    /**
     * Get noVisit
     *
     * @return string
     */
    public function getNoVisit();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Visit
     */
    public function setNama($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getNama();

    /**
     * Set nameSingkat
     *
     * @param string $nameSingkat
     *
     * @return Visit
     */
    public function setNamaSingkat($nameSingkat);

    /**
     * Get nameSingkat
     *
     * @return string
     */
    public function getNamaSingkat();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Visit
     */
    public function setEmail($email);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Visit
     */
    public function setPhone($phone);

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone();

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Visit
     */
    public function setGender($gender);

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender();

    /**
     * Set tempatLahir
     *
     * @param string $tempatLahir
     *
     * @return Visit
     */
    public function setTempatLahir($tempatLahir);

    /**
     * Get tempatLahir
     *
     * @return string
     */
    public function getTempatLahir();

    /**
     * Set tanggalLahir
     *
     * @param \DateTime $tanggalLahir
     *
     * @return Visit
     */
    public function setTanggalLahir($tanggalLahir);

    /**
     * Get tanggalLahir
     *
     * @return \DateTime
     */
    public function getTanggalLahir();

    /**
     * Set agama
     *
     * @param string $agama
     *
     * @return Visit
     */
    public function setAgama($agama);

    /**
     * Get agama
     *
     * @return string
     */
    public function getAgama();

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

    /**
     * Set provinsiId
     *
     * @param integer $provinsiId
     *
     * @return Visit
     */
    public function setProvinsiId($provinsiId);

    /**
     * Get provinsiId
     *
     * @return integer
     */
    public function getProvinsiId();

    /**
     * Set kabupatenId
     *
     * @param integer $kabupatenId
     *
     * @return Visit
     */
    public function setKabupatenId($kabupatenId);

    /**
     * Get kabupatenId
     *
     * @return integer
     */
    public function getKabupatenId();

    /**
     * Set kecamatan
     *
     * @param string $kecamatan
     *
     * @return Visit
     */
    public function setKecamatan($kecamatan);

    /**
     * Get kecamatan
     *
     * @return string
     */
    public function getKecamatan();

    /**
     * Set alamat
     *
     * @param string $alamat
     *
     * @return Visit
     */
    public function setAlamat($alamat);

    /**
     * Get alamat
     *
     * @return string
     */
    public function getAlamat();

    /**
     * Set pos
     *
     * @param string $pos
     *
     * @return Visit
     */
    public function setPos($pos);

    /**
     * Get pos
     *
     * @return string
     */
    public function getPos();

    /**
     * Set asalSekolah
     *
     * @param string $asalSekolah
     *
     * @return Visit
     */
    public function setAsalSekolah($asalSekolah);

    /**
     * Get asalSekolah
     *
     * @return string
     */
    public function getAsalSekolah();

    /**
     * Set jumlahUn
     *
     * @param string $jumlahUn
     *
     * @return Visit
     */
    public function setJumlahUn($jumlahUn);

    /**
     * Get jumlahUn
     *
     * @return string
     */
    public function getJumlahUn();

    /**
     * Set jurusanSekolah
     *
     * @param string $jurusanSekolah
     *
     * @return Visit
     */
    public function setJurusanSekolah($jurusanSekolah);

    /**
     * Get jurusanSekolah
     *
     * @return string
     */
    public function getJurusanSekolah();
    
        /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return Visit
     */
    public function setNationality($nationality);

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality();
}
