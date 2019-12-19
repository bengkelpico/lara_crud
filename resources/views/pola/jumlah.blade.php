<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pola Jumlah</title>
    <link href="/style.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <form @submit.prevent="submit">
            <input type="number" name="jumlah" v-model.number="jumlah"/>
            <div v-for="i in jumlah">
                <template v-for="j in (jumlah - i)">
                    &nbsp;
                </template>
                <template v-for="ii in i">
                    *
                </template>
                <template v-for="j in (jumlah - i)">
                    &nbsp;
                </template>
                <br/>
            </div>
            <div v-for="(i, k) in (jumlah - 1)">
                <template v-for="j in i">
                    &nbsp;
                </template>
                <template v-for="ii in (jumlah - i)">
                    *
                </template>
                <template v-for="j in i">
                    &nbsp;
                </template>
                <br/>
            </div>
        </form>
    </div>
    <script src="/vue.js"></script>
    <script>
    var app = new Vue({
            el: '#app',
            data: {
                jumlah: 3
            },
            computed: {
                star() {
                    var result = '';

                    return result
                }
            },
            methods: {
                submit() {
                    console.log('test')
                }
            }
        })
    </script>
</body>
</html>