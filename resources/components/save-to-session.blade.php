<script>
    !(function () {

        const debounce = (callback, wait) => {
            let timeoutId = null
            return (...args) => {
                window.clearTimeout(timeoutId)
                timeoutId = window.setTimeout(() => {
                    callback.apply(null, args)
                }, wait)
            }
        }

        let windowW = 0
        let windowH = 0

        function update() {
            windowW = (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth)
            windowH = (window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight)
        }

        function launch(w = 0, h = 0) {
            if (w < 1 && h < 1) {
                update()
                saveToSession()
            }
        }


        function saveToSession() {
            fetch('/update-laravel-window-size', {
                method: 'PUT',
                mode: 'same-origin',
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    "X-CSRF-TOKEN": "{{csrf_token()}}"
                },
                body: JSON.stringify({width: windowW, height: windowH})
            }).then()
        }

        window.addEventListener('resize', debounce(() => {
            update()
            saveToSession()
        }, 750))

        window.addEventListener('load', () => launch({{session('windowW', 0)}}, {{session('windowH', 0)}}))

    })()
</script>
