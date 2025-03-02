<template>
    <div class="flex justify-center items-center w-full max-w-[450px] aspect-[16/9] mx-auto relative">
        <svg class="w-[90%] h-full" viewBox="0 -30 300 180" preserveAspectRatio="xMidYMid meet">
            <path
                d="M20,130 A130,130 0 0,1 280,130"
                class="stroke-[var(--gauge-bg-color)] fill-none"
                :style="{ strokeWidth: `calc(var(--gauge-size, 450px) * 0.06)`, strokeLinecap: 'round' }"
            />
            <path
                d="M280,130 A130,130 0 0,0 20,130"
                class="stroke-[var(--gauge-color)] fill-none transition-all duration-500 ease-in-out"
                :stroke-dashoffset="progressOffset"
                stroke-dasharray="410"
                :style="{ strokeWidth: `calc(var(--gauge-size, 450px) * 0.06)`, strokeLinecap: 'round' }"
            />
        </svg>
        <div class="absolute bottom-[25%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-bold"
             :style="{ fontSize: `calc(var(--gauge-size, 450px) * 0.12)` }">
            {{ value }}%
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Number,
            default: 50
        },
        min: {
            type: Number,
            default: 0
        },
        max: {
            type: Number,
            default: 100
        },
        color: {
            type: String,
            default: '#E85D2C'
        },
        backgroundColor: {
            type: String,
            default: '#f1f1f1'
        },
        size: {
            type: String,
            default: '450px'
        },
        thickness: {
            type: String,
            default: '25px'
        }
    },
    computed: {
        progressOffset() {
            const totalLength = 410;
            return totalLength * ((this.max - this.value) / (this.max - this.min));
        }
    },
    mounted() {
        this.$el.style.setProperty('--gauge-size', this.size);
        this.$el.style.setProperty('--gauge-thickness', this.thickness);
        this.$el.style.setProperty('--gauge-color', this.color);
        this.$el.style.setProperty('--gauge-bg-color', this.backgroundColor);
    }
};
</script>
