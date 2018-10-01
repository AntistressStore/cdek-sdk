<?php
/**
 * This code is licensed under the MIT License.
 *
 * Copyright (c) 2018 Appwilio (http://appwilio.com), greabock (https://github.com/greabock), JhaoDa (https://github.com/jhaoda)
 * Copyright (c) 2018 Alexey Kopytko <alexey@kopytko.com> and contributors
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

declare(strict_types=1);

namespace Tests\CdekSDK\Serialization;

use CdekSDK\Common\Attempt;
use CdekSDK\Common\Item;
use CdekSDK\Common\Order;
use CdekSDK\Common\Package;
use CdekSDK\Requests\ScheduleRequest;

/**
 * @covers \CdekSDK\Requests\ScheduleRequest
 */
class ScheduleRequestTest extends TestCase
{
    public function test_can_serialize()
    {
        $request = new ScheduleRequest();
        $request = $request->addOrder(Order::create([
            'DispatchNumber' => 'bar',
        ])->addAttempt(Attempt::create([
            'ID'   => 500,
            'Date' => new \DateTimeImmutable('2018-10-01'),
        ])->addPackage(Package::create([
            'Number'  => 100,
            'BarCode' => 'foo123',
            'Weight'  => 500,
        ])->addItem(new Item([
            'WareKey' => 'NN0001',
            'Cost'    => 500,
            'Payment' => 0,
            'Weight'  => 120,
            'Amount'  => 2,
            'Comment' => 'Test item',
        ])))));

        $this->assertSameAsXML('<?xml version="1.0" encoding="UTF-8"?>
<ScheduleRequest OrderCount="1">
  <Order DispatchNumber="bar">
    <Attempt ID="500" Date="2018-10-01">
      <Package Number="100" BarCode="foo123" Weight="500">
        <Item WareKey="NN0001" Cost="500" Payment="0" Weight="120" Amount="2" Comment="Test item"/>
      </Package>
    </Attempt>
  </Order>
</ScheduleRequest>
', $request);
    }
}
