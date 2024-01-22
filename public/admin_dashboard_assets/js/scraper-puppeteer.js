console.log('test1');

const puppeteer = require('puppeteer-extra');
const StealthPlugin = require('puppeteer-extra-plugin-stealth');

puppeteer.use(StealthPlugin());

const url = 'https://bot.sannysoft.com/';
console.log('test2');

async function run() {
    const browser = await puppeteer.launch({ headless: "new", executablePath: puppeteer.executablePath() });
    const page = await browser.newPage();
    await page.goto(url);
    await page.screenshot({ path: 'public/admin_dashboard_assets/js/bot.png', fullPage: true });

    const title = await page.evaluate(() => document.title);
    console.log(title);

    // Don't forget to close the browser!
    await browser.close();
}

run();
// Attach the click event directly without using jQuery
// document.getElementById('scrapPostButton').addEventListener('click', function () {
//     run();
// });
