<template>
    <circle id="test" :cx="xAxis" :cy="yAxis" r="50"/>
</template>

<script>
export default {
    name: "Player",
    data() {
        return {
            xAxis: 100,
            yAxis: 100,
            xDir: '',
            yDir: '',
            direction: '',
            ticks: 0,
            acceleration: 1,
            velocity: 0,
            maxVelocity: 10,
            // inputs: {
            //     w: false,
            //     a: false,
            //     s: false,
            //     d: false,
            //     ArrowUp: false,
            //     ArrowLeft: false,
            //     ArrowDown: false,
            //     ArrowRight: false,
            // },
            heading: '',
            gameLoop: null
        }
    },
    computed: {
        inputs() {
            return this.xDir || this.yDir;
        },
        noInputs() {
            return !this.xDir && !this.yDir;
        },
        moving() {
            return this.velocity && this.inputsPressed;
        },
        stopping() {
            return this.velocity && !this.inputsPressed;
        }

    },
    created() {
        this.loop();
        window.addEventListener("keydown", event => {
            console.log(event.key)
            event.preventDefault();
            if (event.key === 'ArrowUp' || event.key === 'w') {
                this.yDir = 'up';
            }
            if (event.key === 'ArrowLeft' || event.key === 'a') {
                this.xDir = 'left';
            }
            if (event.key === 'ArrowDown' || event.key === 's') {
                this.yDir = 'down';
            }
            if (event.key === 'ArrowRight' || event.key === 'd') {
                this.xDir = 'right';
            }
            this.direction = this.yDir + this.xDir;
        });
        window.addEventListener("keyup", event => {
            event.preventDefault()
            if (['ArrowUp', 'ArrowDown', 'w', 's'].includes(event.key)) {
                this.yDir = '';
            }
            if (['ArrowLeft', 'ArrowRight', 'a', 'd'].includes(event.key)) {
                this.xDir = '';
            }
        });
    },
    methods: {
        loop() {
            this.ticks++
            this.update()
            requestAnimationFrame(this.loop)
        },
        update() {
            if (this.inputs) {
                if (this.ticks % 10 === 0) {
                    if (this.velocity < this.maxVelocity) {
                        this.velocity += this.acceleration
                    } else {
                        this.velocity = this.maxVelocity;
                    }
                }
                this.movePlayer()
            } else if (this.direction) {
                this.movePlayer()
                if (this.ticks % 10 === 0) {
                    if (this.velocity > 0) {
                        this.velocity -= this.acceleration
                    } else {
                        this.velocity = 0;
                        this.direction = '';
                    }
                }
            }
        },
        movePlayer() {
            console.log(this.direction)
            if (this.direction.includes('up')) {
                this.yAxis -= this.velocity;
            }
            if (this.direction.includes('left')) {
                this.xAxis -= this.velocity;
            }
            if (this.direction.includes('down')) {
                this.yAxis += this.velocity;
            }
            if (this.direction.includes('right')) {
                this.xAxis += this.velocity;
            }
        },
    }
}
</script>
<style scoped>

</style>