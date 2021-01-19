<div class="abc">
	<table style="border: 1px;">
		<thead>
			<th>STT</th>
			<th>Tên Danh Mục</th>
		</thead>
		<tbody>
		{foreach from=$posts item=item}
		
			<tr>
				<td>{$item.id}</td>
				<td>{$item.title}</td>
			</tr>
		{/foreach}

		</tbody>
	</table>
 </div>
 <style>
*{
	padding :0;
	margin:0;
}
.table{
	border:1px solid black !important;
}
.abc{
	display: block;
	width:100%;
	margin-left: 15px;
	margin-right: 15px;
}
 th{
 padding: 10px 20px;
 }
 </style>