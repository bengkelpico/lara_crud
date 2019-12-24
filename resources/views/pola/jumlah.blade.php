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
            <table>
                <tbody>
                    <tr v-for="(top, k) in tops" :key="top + 'top' + k">
                        <td style="text-align:center">
                            <template v-for="t in top">*</template>
                        </td>
                    </tr>
                    <tr v-for="(bottom, k) in bottoms" :key="bottom + 'bottom' + k">
                        <td style="text-align:center">
                            <template v-for="b in bottom">*</template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="/vue.js"></script>
    <script>
    var app = new Vue({
            el: '#app',
            data() {
                return {
                    jumlah: 3
                }
            },
            computed: {
                tops() {
                    var result = []
                    for (var index = 0; index < this.jumlah; index++) {
                        var obj = index * 2 + 1
                        result.push(obj)
                    }
                    return result
                },
                bottoms() {
                    var result = []
                    for (var index = this.jumlah - 1; index > 0; index--) {
                        var obj = index * 2 - 1
                        result.push(obj)
                    }
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