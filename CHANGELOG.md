# CHANGELOG

## 2.1.3 - 2022-08-03

### Fixed

- Fixed issue with multiselect attribute that causes the "- Select -" placeholder be included in user selection in SelectTag.

## 2.1.2 - 2022-08-03

### Fixed

- Added "disabled" attribute in the placeholder option tag of SelectTag.
- Changed multiple="multiple" attribute to just "multiple" in the select tag of SelectTag.

## 2.1.1 - 2022-06-04

### Changed

- Updated dependency phpstan/phpstan to ^1.0

## 2.1.0 - 2021-09-27

### Added

- Add DateDiff::x() method.

## 2.0.5 - 2021-09-22

### Fixed

- Remove default value of 'now' in the first param of AdjustedDateTimeByTimeZone::x()

## 2.0.4 - 2021-02-22

### Fixed

- Make everything pass in PHPStan

## 2.0.3 - 2021-01-23

### Fixed

- Add "Cache-Control: no-store" in Redirect::x() to prevent some browsers from caching the source URL
- Use a country that does not use daylight savings in AdjustedDateTimeByTimeZone unit tests

## 2.0.2 - 2020-05-20

### Fixed

- Fix autofill from POST in SelectTag::x().

## 2.0.1 - 2020-05-20

### Fixed

- Fix issue when selected element is defined in SelectTag::x().

## 2.0.0 - 2020-05-19

### Added

- Add SelectTag::x() method.
- Add IsArrayAssoc::() method.
- Add IsArrayMultiAssoc::() method.
- Add ForcedAssocArray::() method.

### Changed

- Remove exit statement in Redirect::x() method because it is hard to mock, users are recommended to implement their own exit statement.

## 1.5.1 - 2019-07-07

### Fixed

- Add 'Q' character RandomReadable::x() and RandomReadableAlt::x() method because it's not really hard to read unlike O or 0.

## 1.5.0 - 2019-07-04

### Added

- Add RandomReadable::x() method.
- Add RandomReadableAlt::x() method.

## 1.4.1 - 2019-04-25

### Fixed

- Allow one-dimensional array in HtmlSpecialCharsArrays::x() method.

## 1.4.0 - 2019-04-25

### Added

- Add HtmlSpecialChars::x() method.
- Add HtmlSpecialCharsArrays::x() method.

## 1.3.1 - 2019-04-17

### Fixed

- Fix bug in PathSegment::x() when $url parameter has no segments.

## 1.3.0 - 2019-04-16

### Added

- Add AnchorTag::x() method.
- Add ImageTag::x() method.

## 1.2.0 - 2019-04-07

### Added

- Add NullifiedArray::x() method.

## 1.1.0 - 2019-04-05

### Added

- Add Redirect::x() method.

## 1.0.0 - 2019-03-20

- Release first version.