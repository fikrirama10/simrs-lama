<table class='table table-bordered'>
				<tr>  
					<th colspan="3">TNI AU</th>
					<th colspan="3">TNI AD</th>
					<th colspan="3">TNI AL</th>
					<th align=center rowspan="2">BPJS </th>
					<th align=center rowspan="2">Yanmas</th>
					<th align=center rowspan="2">Jumlah</th>
				</tr>
				<tr>
					<!-- TNI AU -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AD -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					<!-- TNI AL -->
					<th scope="col">M</th>
					<th scope="col">S</th>
					<th scope="col">K</th>
					
				</tr>
				
				<?php  for($a=0; $a < count($json2); $a++){ ?>
						<tr>			
							<td><?= $json2[$a]['TniauMil'] ?></td>
							<td><?= $json2[$a]['TniauSip'] ?></td>
							<td><?= $json2[$a]['TniauKel'] ?></td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td>0</td>
							<td>0</td>
							<td>0</td>
							
							<td><?= $json2[$a]['Bpjs'] ?></td>
							<td><?= $json2[$a]['Yanmas'] ?></td>
							<td><?= $json2[$a]['Jumlah'] ?></td>		
						</tr>
				<?php } ?>
		</table>