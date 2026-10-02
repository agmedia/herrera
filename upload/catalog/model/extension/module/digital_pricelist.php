<?php
class ModelExtensionModuleDigitalPricelist extends Model {
	public function generate() {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->generate();
	}

	public function getCurrentPath($format) {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->getCurrentPath($format);
	}

	public function getCurrentFilename($format) {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->getCurrentFilename($format);
	}

	public function getArchives() {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->getArchives();
	}

	public function getArchivePath($filename) {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->getArchivePath($filename);
	}

	public function acquireReadLock() {
		$this->load->library('digital_pricelist');

		return $this->digital_pricelist->acquireReadLock();
	}

	public function releaseReadLock($lock) {
		$this->load->library('digital_pricelist');
		$this->digital_pricelist->releaseReadLock($lock);
	}
}
