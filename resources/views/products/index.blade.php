<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Product</title>
    <link href="/style.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <a href="/" @click.prevent="tambah = !tambah">Tambah</a>
        <div v-show="tambah">
            <form @submit.prevent="simpan(null)">
                <input v-model="form.merk" placeholder="Merk" type="text"/>
                <br>
                <input v-model.number="form.harga" placeholder="Harga" type="number"/>
                <br>
                <input v-model.number="form.stok" placeholder="Stok" type="number"/>
                <br>
                <input @change="change" placeholder="Gambar" type="file"/>
                <br>
                <button>Simpan</button>
            </form>
            <br>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products">
                    <td>@{{ product.id_product }}</td>
                    <td>@{{ product.merk }}</td>
                    <td>@{{ product.harga }}</td>
                    <td>@{{ product.stok }}</td>
                    <td>@{{ product.gbr_product }}</td>
                    <td>
                        <button @click="edit(product)">Edit</button>
                        <button @click="del(product)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-show="ubah.id_product">
        <br>
        <h2>Ubah @{{ ubah.merk }}</h2>
         <form @submit.prevent="simpan(ubah)">
                <input v-model="ubah.merk" placeholder="Merk" type="text"/>
                <br>
                <input v-model.number="ubah.harga" placeholder="Harga" type="number"/>
                <br>
                <input v-model.number="ubah.stok" placeholder="Stok" type="number"/>
                <br>
                <input @change="change('ubah')" placeholder="Gambar" type="file"/>
                <br>
                <button>Simpan</button>
            </form>
        </div>
    </div>
    <script src="/vue.js"></script>
    <script>
    var app = new Vue({
            el: '#app',
            data: {
                products: [],
                tambah: false,
                form: {
                    merk: '',
                    harga: 0,
                    stok: 0,
                    gbr_product: ''
                },
                ubah: {},
                preview: ''
            },
            mounted() {
                this.getProduct()
            },
            methods: {
                getProduct() {
                    var _this = this;
                    fetch('/api/products')
                        .then(r => r.json())
                        .then(r => _this.products = r)
                        .catch(err => console.log(err))
                },
                simpan(data = null){
                    var formData = new FormData();
                    console.log(data, 'asd')
                    url = !data ? '/api/products' : '/api/products/' + data.id_product
                    data = !data ? this.form : data
                    formData.append('merk', data.merk);
                    formData.append('harga', data.harga);
                    formData.append('stok', data.stok);
                    formData.append('gbr_product', data.gbr_product);
                    const options = {
                        method: 'POST',
                        body: formData
                    };
                    _this = this
                    fetch(url, options)
                        .then(r => r.json())
                        .then(r => {
                            _this.form = {
                                merk: '',
                                harga: 0,
                                stok: 0,
                                gbr_product: ''
                            }
                            _this.tambah = false
                            _this.ubah = {}
                            if(_this.preview) {
                                URL.revokeObjectURL(_this.preview);
                            }
                            _this.getProduct();
                        })
                        .catch(err => console.log(err));
                },
                change(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.form.gbr_product = files[0];
                    try {
                        if(this.preview) {
                            URL.revokeObjectURL(this.preview);
                        }
                        this.preview = URL.createObjectURL(files[0])
                    } catch (err) {
                        console.log(err)
                    }
                },
                edit(data) {
                    this.ubah = JSON.parse(JSON.stringify(data));
                },
                del(product) {
                    const options = {
                        method: "DELETE"
                    };
                    _this = this
                    fetch('/api/products/' + product.id_product, options)
                        .then(r => r.json())
                        .then(r => {
                            _this.form = {
                                merk: '',
                                harga: 0,
                                stok: 0,
                                gbr_product: ''
                            }
                            _this.tambah = false
                            _this.ubah = {}
                            if(_this.preview) {
                                URL.revokeObjectURL(_this.preview);
                            }
                            _this.getProduct();
                        })
                        .catch(err => console.log(err));
                }
            }
        })
    </script>
</body>
</html>