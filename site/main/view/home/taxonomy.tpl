<!DOCTYPE html>
<html>
<head>
	<title>Danh Mục</title>
	<link href="{$arg.stylesheet}css/taxomamy.css" rel="stylesheet">
</head>
<body>
<div class="abc">
	<h1>Danh sách danh mục</h1>	
	<div class="bcd">
		<label>Phân loại danh mục</label>
		<select id="taxonomy_id" class="taxonomy" onchange="changeLink(this.value)">
			<option>Lựa chọn</option>
			{foreach from=$taxonomy_name item=i }
				<option value="{$i.id}">{$i.name}</option>
			{/foreach}
		</select> 
	</div>
		<script type="text/javascript">
		
		function changeLink(id) {
			location.href= '?mod=home&site=taxonomy&taxonomy_id='+id;
		}
		</script>
	<table >
		<thead>
			<th width="3%" >ID</th>
			<th width="7%">Tiêu Đề</th>
			<th width="5%">Danh Mục</th>
			<th width="5%">Kiểu</th>
			<th width="80%">Nội dung</th>
		</thead>
		<tbody>
			{foreach from=$result item=item}
			<tr>
				<td>{$item.id}</td>
				<td>{$item.title}</td>
				<td>{$item.taxonomy_id}</td>
				<td>{$item.type}</td>
				<td>{$item.content}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>

</div>

</body>
</html>