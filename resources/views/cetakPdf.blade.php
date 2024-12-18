
<h3><center>Laporan Data Product</center></h3>
<table border="1" cellspacing="0" cellpadding="7">
  <tr>
    <th>#ID</th>
    <th>Title</th>
    <th>Price</th>
    <th>Tahun Pengadaan</th>
    <th>Product Code</th>
    <th>Description</th>
    <th>Lokasi Pengguna</th>
    <th>Dokumentasi</th>
  </tr>
  @foreach($product as $s) 
  <tr>
    <td>{{$s->id}}</td>
    <td>{{$s->title}}</td>
    <td>Rp.{{ number_format($s->price,0, ',', '.') }}</td>
    <td>{{$s->tahun_pengadaan}}</td>
    <td>{{$s->product_code}}</td>
    <td>{{$s->description}}</td>
    <td>{{$s->lokasi_pengguna}}</td>
    <td>                    
      <img height="100px" width="100px" src="storage\products\{{ $s->image }}" >
      
      
      
    </td>
  </tr>
  @endforeach
</table>