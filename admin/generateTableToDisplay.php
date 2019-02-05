<!-- 
	UN id: 17421492
 -->
 <?php 
	class GenerateTableToDisplay{
		public $tableSubTilte;
		public $getRows = [];
		public function setTableSubTitle($tableSubTilte){
			$this->tableSubTilte = $tableSubTilte;
		}
		public function setTableRows($setRows){
			$this->getRows[] = $setRows;
		}
		public function getRequiredHTML(){
			$resultGenerator = "";
			//Generate table, thead, tr tag
			$resultGenerator .= "<table><thead><tr>";
			foreach ($this->tableSubTilte as $subTitle) {
				//Add title to table head
				$resultGenerator .= "<th>$subTitle</th>";
			}
			$resultGenerator .= "</tr></thead><tbody>";
			foreach ($this->getRows as $setRowsOnTable) {
				$resultGenerator .= "<tr>";
				foreach ($setRowsOnTable as $getRow) {
					//Add row on the generated table
					$resultGenerator .= "<td>$getRow</td>";
				}
				$resultGenerator .= "</tr>";
			}
			$resultGenerator .= "</tbody></table>";
			return $resultGenerator;
		}
	}
?>
