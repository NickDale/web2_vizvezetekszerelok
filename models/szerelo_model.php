<?php

class Szerelo_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "select * from szerelo
			where deactivate =0;";
			$stmt = $connection->query($sql);
			$valtozo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$retData['eredmeny'] = "ok";
			$retData['adat'] = $valtozo;
		} catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
		}
		return $retData;
	}

	public function listAllSzerelo(): array
	{
		$result  = Database::getConnection()
			->query('SELECT * FROM szerelo')
			->fetchAll(PDO::FETCH_ASSOC);
		$szerelok = [];
		foreach ($result as $row) {
			$szerelok[] = new Szerelo($row);
		}
		return $szerelok;
	}

	public function szerelok(): array
	{
		$result  = Database::getConnection()
			->query('SELECT * FROM szerelo')
			->fetchAll(PDO::FETCH_ASSOC);

		$sql = 'SELECT * FROM szerelo';

		if (!$_SESSION['userlevel'] == '___1') {
			$sql .= " WHERE sz.nev LIKE'" . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . "';";
		}

		$szerelok = [];
		foreach ($result as $row) {
			$szerelok[] = new Szerelo($row);
		}
		return $szerelok;
	}

	public function create($nev, $kezdev)
	{
		Database::getConnection()
			->prepare("INSERT INTO szerelo (nev,kezdev) VALUES(?,?);")
			->execute([$nev, $kezdev]);
	}

	public function findById($id): Szerelo|null
	{
		$stmt = Database::getConnection()
			->prepare('SELECT * FROM szerelo WHERE az = ?');
		$stmt->execute([$id]);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			return null;
		}
		return new Szerelo($result);
	}

	public function update(Szerelo $szerelo)
	{
		$stmt = Database::getConnection()
			->prepare('UPDATE szerelo SET nev = ?, kezdev = ?, deactivate = ? WHERE az = ?');
		$stmt->execute([
			$szerelo->getNev(),
			$szerelo->getKezdoEv(),
			$szerelo->active ? 0 : 1,
			$szerelo->getId()
		]);
	}

	public function deactivate($id)
	{
		$stmt = Database::getConnection()
			->prepare('UPDATE szerelo SET deactivate = 1 WHERE az = ?');
		$stmt->execute([$id]);
	}
}
