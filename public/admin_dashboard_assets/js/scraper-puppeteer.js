import puppeteer from 'puppeteer-extra';
import StealthPlugin from 'puppeteer-extra-plugin-stealth';

puppeteer.use(StealthPlugin());

import { executablePath } from 'puppeteer';

const url = 'https://bot.sannysoft.com/';

async function run() {
    const browser = await puppeteer.launch({ headless: "new", executablePath: executablePath() });
    const page = await browser.newPage();
    await page.goto(url);  // Use the variable 'url' instead of the string 'url'
    await page.screenshot({ path: 'public/admin_dashboard_assets/js/bot.png', fullPage: true });  // Corrected method name

    // Don't forget to close the browser!
    await browser.close();
}

run();
