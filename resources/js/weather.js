class Weather {

    constructor() {
        this.url    = '/weather'
        this.city   = 'batangas'
        this.country= 'PH'
    }

    async onLoadPage() {       

        const self = this

        try {
            const fetchData = await self.processData(this.url, 'POST', {
                city    : self.city,
                country : self.country
            });

            if (!fetchData || fetchData.error) {
                console.error(fetchData?.error || 'No data returned.');
                $('.description_container').text('Unable to fetch weather data.');
                return;
            }

            const { data, source } = fetchData;

            const ucwords = (str) =>
                str.toLowerCase().replace(/\b\w/g, (char) => char.toUpperCase());

            const today = new Date();
            const hours = today.getHours();

            const formatDate = (date) => {
                const options = { weekday: 'long', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            };

            const formatTime = (date) => {
                const options = { hour: 'numeric', minute: '2-digit', hour12: true };
                return date.toLocaleTimeString('en-US', options);
            };

            const humidity = Math.floor(data.main.humidity);
            
            const classification =
                    humidity <= 70 ? 'moderately high' :
                    humidity <= 80 ? 'high' : 'very high';

            const country  = data.sys.country.toLowerCase() === 'ph' ? 'Philippines' : data.sys.country

            $('.city').text(`${ucwords(data.name)},`).addClass('me-2'); // City
            $('.country').text(`${ucwords(country)} - `).addClass('me-2'); // Country
            $('.date').text(formatDate(today)); // Date

            $('.celcius').text(Math.floor(data.main.temp)).append($('<i>').addClass('bi bi-circle')); // Celcius
            $('.description_container').text(ucwords(data.weather[0].description)); // Description
            $('.time').text(formatTime(today)); // Time
            $('.feels_like').text(Math.floor(data.main.feels_like)).append($('<i>').addClass('bi bi-circle')); // Feels Like
            $('.humidity').text(`${humidity}%`); // Humidity
            $('.source').text(ucwords(source)); // Source
            $('.humidity_desc').text(ucwords(classification)); // Classification


            const time_of_day = (hours >= 18 || hours < 6) ? 'night'    : 
                                (hours >= 6 && hours < 12) ? 'morning'  : 'afternoon';

            $('body').addClass(time_of_day);

        } catch (error) {
            console.error('Error fetching weather:', error);
            $('.description_container').text('Unable to fetch weather data.');
        }
    }

    async processData(url, method = 'POST', data = {}) {
        return $.ajax({
            url: window.location.origin + url,
            type: method,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            data: data,
        })
    }
}

export default new Weather;