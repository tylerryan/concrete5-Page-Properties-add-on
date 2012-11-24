# $Id: Makefile 2012-11-19 10:45:07Z eliovir $
EDITOR=lokalize
LANG=eo
DOMAIN=messages
L10N=languages

all:   update-po mo

help:
	@echo 'This `Makefile` is provided to do the usual actions:'
	@echo ''
	@echo '- update the messages, type `make update-po`'
	@echo '- compile the .po files into .mo files, type `make mo`'
	@echo '- edit the Esperanto translation file with `lokalize`, type `make edit` or'
	@echo '  `make edit LANG=eo EDITOR=lokalize`. To edit the French file with `poedit`,'
	@echo '   type `make edit LANG=fr_FR EDITOR=poedit`,'
	@echo '- add a new language, type `make create LANG=XX`, where XX is the language code,'
	@echo '- see the translation statistics, type `make stat`'


pot: $(DOMAIN).pot

$(DOMAIN).pot: $(SRC)
	touch $(DOMAIN).pot
	find ./ -iname '*.php' -exec xgettext --keyword=t --from-code=utf-8 --default-domain=$(DOMAIN) --language=PHP -p ./ --output=$(DOMAIN).pot -j {} \;

mo:
	@for PO in `ls $(L10N)/*/LC_MESSAGES/$(DOMAIN).po` ; do \
		msgfmt $$PO --output `echo $$PO | sed -e "s/\.po$$/.mo/"` ; \
	done ;

clean:
	rm -f $(L10N)/*/LC_MESSAGES/$(DOMAIN).po~

create: pot
	@mkdir -p $(L10N)/$(LANG)/LC_MESSAGES/
	msginit --no-translator --locale $(LANG) --output-file $(L10N)/$(LANG)/LC_MESSAGES/$(DOMAIN).po --input ./$(DOMAIN).pot
	@rm -f ./$(DOMAIN).pot

edit: update-po
	$(EDITOR) $(L10N)/$(LANG)/LC_MESSAGES/$(DOMAIN).po

update-po: $(DOMAIN).pot
	@for PO in `ls $(L10N)/*/LC_MESSAGES/$(DOMAIN).po` ; do \
		echo -n "$$PO : "; \
		msgmerge --update $$PO ./$(DOMAIN).pot ; \
	done ;
	@rm -f ./$(DOMAIN).pot

stat:
	@for PO in `ls $(L10N)/*/LC_MESSAGES/$(DOMAIN).po` ; do \
		echo -n "$$PO : "; \
		msgfmt --statistics $$PO ; \
	done ;
	@rm -f messages.mo
